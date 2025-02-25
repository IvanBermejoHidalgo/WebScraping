from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time
import csv

#URL of CNN's homepage
cnn_url = "https://www.formula1.com/en/drivers"
teams_url = "https://www.formula1.com/en/teams"
races2024_url = "https://www.formula1.com/en/results/2024/races"

#Function to scrape headlines using Selenium
def drivers(url):
    options = Options()
    options.headless = False  # Set to True for headless mode
    driver = webdriver.Chrome(options=options)

    #Navigate to the webpage
    driver.get(url)

    # FUNCIONA CORRECTAMENTE
    try:
        #numPos = driver.find_elements(By.CLASS_NAME, 'f1-heading-black.font-formulaOne.tracking-normal.font-black.non-italic.text-fs-42px.leading-none')
        nombres = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.uppercase.font-normal.non-italic.f1-heading__body.font-formulaOne')
        apellidos = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-18px.leading-tight.uppercase.font-bold.non-italic.f1-heading__body.font-formulaOne')
        scuderias = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.normal-case.font-normal.non-italic.f1-heading__body.font-formulaOne.text-greyDark')
        #puntos = driver.find_elements(By.CLASS_NAME, 'f1-heading-wide.font-formulaOneWide.tracking-normal.font-normal.non-italic.text-fs-18px.leading-none.normal-case')
        imgPaises = driver.find_elements(By.CLASS_NAME, 'flex.relative.items-center.border-l-normal.pl-xs.border-current')
        imgPilotos = driver.find_elements(By.CLASS_NAME, 'f1-c-image.ml-0.mr-0.pr-s.max-w-3/4')
        #numPilotos = driver.find_elements(By.CLASS_NAME, 'flex.items-baseline')

        with open("drivers.sql", "w", newline="", encoding="utf-8") as file:
            writer = csv.writer(file, delimiter=';')  # Usa ';' como separador
            # for numPo, nombre, apellido, scuderia, punto, imgPais, numPiloto in zip(numPos,nombres, apellidos, scuderias, puntos, imgPaises, numPilotos):
            for nombre, apellido, scuderia, imgPais, imgPilo in zip(nombres, apellidos, scuderias, imgPaises, imgPilotos):
                imgPaises_src = imgPais.find_element(By.TAG_NAME, 'img').get_attribute('src')
                imgPaises_alt = imgPais.find_element(By.TAG_NAME, 'img').get_attribute('alt')

                imgPilotos_src = imgPilo.find_element(By.TAG_NAME, 'img').get_attribute('src')
                #numPilotos_src = numPiloto.find_element(By.TAG_NAME, 'img').get_attribute('src')
                #numdriver = numPiloto.find_element(By.TAG_NAME, 'img').get_attribute('alt')
                #writer.writerow([numPo.text.strip(),nombre.text.strip(), apellido.text.strip(), scuderia.text.strip(), punto.text.strip(), imgPaises_alt.strip(), numPilotos_alt.strip(), imgPaises_src.strip(), numPilotos_src.strip()])
                # Crea la instrucción SQL
#                 insert_query = f"""INSERT INTO drivers (driver_number, position, first_name, last_name, team, points, country, flag_url, logo_url) VALUES 
# ('{numdriver.strip()}', {numPo.text.strip()}, '{nombre.text.strip()}', '{apellido.text.strip()}', '{scuderia.text.strip()}', {punto.text.strip()}, 
# '{imgPaises_alt.strip()}', '{imgPaises_src.strip()}', '{numPilotos_src.strip()}');"""
                
                insert_query = f"""INSERT INTO drivers (first_name, last_name, team, country, flag_url, piloto_img) VALUES 
('{nombre.text.strip()}', '{apellido.text.strip()}', '{scuderia.text.strip()}', '{imgPaises_alt.strip()}', '{imgPaises_src.strip()}', '{imgPilotos_src.strip()}');"""
            
                file.write(insert_query + "\n")
            

        print("Datos guardados en 'drivers.sql'")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        # Cerrar el navegador
        driver.quit()




def teams(url):
    options = Options()
    options.headless = False
    driver = webdriver.Chrome(options=options)
    driver.get(url)

    try:
        equipos = driver.find_elements(By.CLASS_NAME, 'f1-driver-listing-card')

        with open("teams.sql", "w", newline="", encoding="utf-8") as file:
            writer = csv.writer(file, delimiter=';')
            #writer.writerow(["Posición", "Equipo", "Piloto 1", "Piloto 2", "Puntos"])

            for equipo in equipos:
                #posicion = equipo.find_element(By.CLASS_NAME, 'f1-heading-black.font-formulaOne.tracking-normal.font-black.non-italic.text-fs-42px.leading-none').text.strip()
                nombre_equipo = equipo.find_element(By.CLASS_NAME, 'f1-inner-wrapper.flex.flex-col.gap-micro.text-brand-black').text.strip()

                pilotos = equipo.find_elements(By.CLASS_NAME, 'f1-team-driver-name')
                if len(pilotos) >= 2:
                    piloto1 = pilotos[0].find_elements(By.CLASS_NAME, 'f1-heading')[1].text.strip()
                    piloto2 = pilotos[1].find_elements(By.CLASS_NAME, 'f1-heading')[1].text.strip()
                    

                #puntos = equipo.find_element(By.CLASS_NAME, 'f1-heading-wide.font-formulaOneWide.tracking-normal.font-normal.non-italic.text-fs-18px.leading-none.normal-case').text.strip()
                imglogo = equipo.find_element(By.CLASS_NAME, 'f1-c-image').get_attribute('src')
                imgcoche = equipo.find_element(By.XPATH, './/div[contains(@class, "flex items-baseline justify-center")]/img').get_attribute('src')
                #writer.writerow([posicion, nombre_equipo, piloto1, piloto2, puntos])
                # insert_query = f"""INSERT INTO teams (team_position, team_name, driver1, driver2, points, img_team, img_car) VALUES 
                # ({posicion}, '{nombre_equipo}', '{piloto1}', '{piloto2}', {puntos}, '{imglogo}', '{imgcoche}');"""

                insert_query = f"""INSERT INTO teams (team_name, driver1, driver2, img_team, img_car) VALUES 
                ('{nombre_equipo}', '{piloto1}', '{piloto2}', '{imglogo}', '{imgcoche}');"""
                
                # Escribe la consulta en el archivo
                file.write(insert_query + "\n")

        print("Datos guardados en 'teams.sql'")

    except Exception as e:
        print(f"Error: {e}")
    finally:
        driver.quit()




def races2024(url):
    options = Options()
    options.headless = False  # Cambia a True si no necesitas ver el navegador
    driver = webdriver.Chrome(options=options)

    try:
        # Navegar a la URL
        driver.get(url)

        # Esperar a que la tabla de carreras esté presente
        WebDriverWait(driver, 10).until(
            EC.presence_of_element_located((By.CSS_SELECTOR, 'table.resultsarchive-table'))
        )

        # Encontrar las filas de la tabla
        carreras = driver.find_elements(By.CSS_SELECTOR, 'table.resultsarchive-table tbody tr')

        if not carreras:
            print("No se encontraron carreras en la tabla.")
            return

        with open("races.sql", "w", encoding="utf-8") as file:
            for carrera in carreras:
                try:
                    # Extraer datos de la fila
                    grand_prix = carrera.find_element(By.CSS_SELECTOR, 'td a').text.strip()
                    date = carrera.find_element(By.CSS_SELECTOR, 'td:nth-child(2) p').text.strip()
                    winner = carrera.find_element(By.CSS_SELECTOR, 'td:nth-child(3) p').text.strip()
                    car = carrera.find_element(By.CSS_SELECTOR, 'td:nth-child(4) p').text.strip()
                    laps = carrera.find_element(By.CSS_SELECTOR, 'td:nth-child(5) p').text.strip()
                    race_time = carrera.find_element(By.CSS_SELECTOR, 'td:nth-child(6) p').text.strip()

                    # Crear la instrucción SQL
                    insert_query = (
                        f"INSERT INTO races (grand_prix, race_date, winner, car, laps, race_time) VALUES "
                        f"('{grand_prix}', '{date}', '{winner}', '{car}', {laps}, '{race_time}');"
                    )

                    # Escribir la consulta en el archivo
                    file.write(insert_query + "\n")

                except Exception as row_error:
                    print(f"Error al procesar una carrera: {row_error}")

        print("Datos guardados en 'races.sql'")

    except Exception as e:
        print(f"Error al obtener los datos: {e}")

    finally:
        driver.quit()






#Scrape headlines using Selenium
drivers(cnn_url)
#teams(teams_url)
#races2024(races2024_url)