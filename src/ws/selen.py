from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import mysql.connector

# Configuración de la base de datos
db_config = {
    'host': 'localhost',
    'user': 'usuario',
    'password': 'password',
    'database': 'formula1'
}

# Función para conectar a la base de datos
def connect_to_db():
    try:
        connection = mysql.connector.connect(**db_config)
        return connection
    except mysql.connector.Error as err:
        print(f"Error al conectar a la base de datos: {err}")
        return None

# Función para ejecutar una consulta SQL
def execute_query(connection, query):
    try:
        cursor = connection.cursor()
        cursor.execute(query)
        connection.commit()
        cursor.close()
    except mysql.connector.Error as err:
        print(f"Error al ejecutar la consulta: {err}")

# URL de las páginas
drivers_url = "https://www.formula1.com/en/drivers"
teams_url = "https://www.formula1.com/en/teams"
races2024_url = "https://www.formula1.com/en/results/2024/races"

# Función para scrapear y guardar datos de los equipos
def scrape_teams(url):
    options = Options()
    options.headless = False
    driver = webdriver.Chrome(options=options)
    driver.get(url)

    connection = connect_to_db()

    try:
        equipos = driver.find_elements(By.CLASS_NAME, 'f1-driver-listing-card')

        with open("teams.sql", "w", newline="", encoding="utf-8") as file:
            for equipo in equipos:
                nombre_equipo = equipo.find_element(By.CLASS_NAME, 'f1-inner-wrapper.flex.flex-col.gap-micro.text-brand-black').text.strip()
                imglogo = equipo.find_element(By.CLASS_NAME, 'f1-c-image').get_attribute('src')
                imgcoche = equipo.find_element(By.XPATH, './/div[contains(@class, "flex items-baseline justify-center")]/img').get_attribute('src')

                insert_query = f"""INSERT INTO teams (team_name, img_team, img_car) VALUES 
                ('{nombre_equipo}', '{imglogo}', '{imgcoche}');"""
                
                file.write(insert_query + "\n")
                if connection:
                    execute_query(connection, insert_query)

        print("Datos de equipos guardados en 'teams.sql' y en la base de datos")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        driver.quit()
        if connection:
            connection.close()

# Función para scrapear y crear team_mapping
def scrape_and_create_team_mapping(teams_url, races_url):
    options = Options()
    options.headless = False

    # Scrapear nombres de equipos desde la página de equipos
    driver = webdriver.Chrome(options=options)
    driver.get(teams_url)
    team_names = set()

    try:
        equipos = driver.find_elements(By.CLASS_NAME, 'f1-driver-listing-card')
        for equipo in equipos:
            nombre_equipo = equipo.find_element(By.CLASS_NAME, 'f1-inner-wrapper.flex.flex-col.gap-micro.text-brand-black').text.strip()
            team_names.add(nombre_equipo)
    except Exception as e:
        print(f"Error al scrapear equipos: {e}")
    finally:
        driver.quit()

    # Scrapear nombres de equipos desde la página de carreras
    driver = webdriver.Chrome(options=options)
    driver.get(races_url)
    race_team_names = set()

    try:
        tbody = driver.find_element(By.TAG_NAME, 'tbody')
        rows = tbody.find_elements(By.TAG_NAME, 'tr')

        for row in rows:
            try:
                columns = row.find_elements(By.TAG_NAME, 'td')
                car_team_name = columns[3].find_element(By.TAG_NAME, 'p').text.strip()
                race_team_names.add(car_team_name)
            except Exception as row_error:
                print(f"Error al procesar una fila: {row_error}")
    except Exception as e:
        print(f"Error al scrapear equipos de carreras: {e}")
    finally:
        driver.quit()

    # Crear team_mapping
    connection = connect_to_db()

    try:
        with open("team_mapping.sql", "w", encoding="utf-8") as file:
            for team_name in team_names:
                for race_team_name in race_team_names:
                    if team_name.lower() in race_team_name.lower() or race_team_name.lower() in team_name.lower():
                        # Verificar si el valor ya existe en la base de datos
                        check_query = f"SELECT * FROM team_mapping WHERE team_name = '{team_name}' AND race_team_name = '{race_team_name}';"
                        cursor = connection.cursor()
                        cursor.execute(check_query)
                        result = cursor.fetchone()

                        if not result:  # Si no existe, insertar
                            insert_query = f"""INSERT INTO team_mapping (team_name, race_team_name) VALUES 
                            ('{team_name}', '{race_team_name}');"""
                            
                            file.write(insert_query + "\n")
                            if connection:
                                execute_query(connection, insert_query)

        print("Datos de team_mapping guardados en 'team_mapping.sql' y en la base de datos")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        if connection:
            connection.close()

# Función para scrapear y guardar datos de los pilotos
def scrape_drivers(url):
    options = Options()
    options.headless = False
    driver = webdriver.Chrome(options=options)
    driver.get(url)

    connection = connect_to_db()

    try:
        nombres = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.uppercase.font-normal.non-italic.f1-heading__body.font-formulaOne')
        apellidos = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-18px.leading-tight.uppercase.font-bold.non-italic.f1-heading__body.font-formulaOne')
        scuderias = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.normal-case.font-normal.non-italic.f1-heading__body.font-formulaOne.text-greyDark')
        imgPaises = driver.find_elements(By.CLASS_NAME, 'flex.relative.items-center.border-l-normal.pl-xs.border-current')
        imgPilotos = driver.find_elements(By.XPATH, '//img[contains(@class, "f1-c-image") and contains(@class, "ml-0") and contains(@class, "mr-0") and contains(@class, "pr-s") and contains(@class, "max-w-3/4")]')

        with open("drivers.sql", "w", newline="", encoding="utf-8") as file:
            for nombre, apellido, scuderia, imgPais, imgPilo in zip(nombres, apellidos, scuderias, imgPaises, imgPilotos):
                imgPaises_src = imgPais.find_element(By.TAG_NAME, 'img').get_attribute('src')
                imgPaises_alt = imgPais.find_element(By.TAG_NAME, 'img').get_attribute('alt')
                imgPilotos_src = imgPilo.get_attribute('src')

                insert_query = f"""INSERT INTO drivers (first_name, last_name, team_name, country, flag_url, piloto_img) VALUES 
('{nombre.text.strip()}', '{apellido.text.strip()}', '{scuderia.text.strip()}', '{imgPaises_alt.strip()}', '{imgPaises_src.strip()}', '{imgPilotos_src.strip()}');"""
                
                file.write(insert_query + "\n")
                if connection:
                    execute_query(connection, insert_query)

        print("Datos de pilotos guardados en 'drivers.sql' y en la base de datos")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        driver.quit()
        if connection:
            connection.close()

# Función para scrapear y guardar datos de las carreras
def scrape_races(url):
    options = Options()
    options.headless = False
    driver = webdriver.Chrome(options=options)
    driver.get(url)

    connection = connect_to_db()

    try:
        tbody = driver.find_element(By.TAG_NAME, 'tbody')
        rows = tbody.find_elements(By.TAG_NAME, 'tr')

        with open("races.sql", "w", encoding="utf-8") as file:
            for row in rows:
                try:
                    columns = row.find_elements(By.TAG_NAME, 'td')
                    grand_prix = columns[0].find_element(By.TAG_NAME, 'p').text.strip()
                    date = columns[1].find_element(By.TAG_NAME, 'p').text.strip()
                    winner = columns[2].find_element(By.TAG_NAME, 'p').text.strip()
                    car = columns[3].find_element(By.TAG_NAME, 'p').text.strip()
                    laps = columns[4].find_element(By.TAG_NAME, 'p').text.strip()

                    insert_query = (
                        f"INSERT INTO races (grand_prix, race_date, winner, car_team_name, laps) VALUES "
                        f"('{grand_prix}', '{date}', '{winner}', '{car}', {laps});"
                    )
                    file.write(insert_query + "\n")
                    if connection:
                        execute_query(connection, insert_query)

                except Exception as row_error:
                    print(f"Error al procesar una fila: {row_error}")

        print("Datos de carreras guardados en 'races.sql' y en la base de datos")
    except Exception as e:
        print(f"Error al obtener los datos: {e}")
    finally:
        driver.quit()
        if connection:
            connection.close()

# Ejecutar las funciones en el orden correcto
scrape_teams(teams_url)  # Primero, insertar en `teams`
scrape_and_create_team_mapping(teams_url, races2024_url)  # Luego, insertar en `team_mapping`
scrape_drivers(drivers_url)  # Después, insertar en `drivers`
scrape_races(races2024_url)  # Finalmente, insertar en `races`