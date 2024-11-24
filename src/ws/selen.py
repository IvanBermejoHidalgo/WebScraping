from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import time
import csv

#URL of CNN's homepage
cnn_url = "https://www.formula1.com/en/drivers"
teams_url = "https://www.formula1.com/en/teams"

#Function to scrape headlines using Selenium
def drivers(url):
    options = Options()
    options.headless = False  # Set to True for headless mode
    driver = webdriver.Chrome(options=options)

    #Navigate to the webpage
    driver.get(url)

    # FUNCIONA CORRECTAMENTE
    try:
        numPos = driver.find_elements(By.CLASS_NAME, 'f1-heading-black.font-formulaOne.tracking-normal.font-black.non-italic.text-fs-42px.leading-none')
        nombres = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.uppercase.font-normal.non-italic.f1-heading__body.font-formulaOne')
        apellidos = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-18px.leading-tight.uppercase.font-bold.non-italic.f1-heading__body.font-formulaOne')
        scuderias = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.normal-case.font-normal.non-italic.f1-heading__body.font-formulaOne.text-greyDark')
        puntos = driver.find_elements(By.CLASS_NAME, 'f1-heading-wide.font-formulaOneWide.tracking-normal.font-normal.non-italic.text-fs-18px.leading-none.normal-case')
        imgPaises = driver.find_elements(By.CLASS_NAME, 'flex.relative.items-center.border-l-normal.pl-xs.border-current')
        numPilotos = driver.find_elements(By.CLASS_NAME, 'flex.items-baseline')

        with open("drivers.csv", "w", newline="", encoding="utf-8") as file:
            writer = csv.writer(file, delimiter=';')  # Usa ';' como separador
            # writer.writerow(["nombre", "apellido"])  # Cabecera
            for numPo, nombre, apellido, scuderia, punto, imgPais, numPiloto in zip(numPos,nombres, apellidos, scuderias, puntos, imgPaises, numPilotos):
                imgPaises_src = imgPais.find_element(By.TAG_NAME, 'img').get_attribute('src')
                imgPaises_alt = imgPais.find_element(By.TAG_NAME, 'img').get_attribute('alt')
                numPilotos_src = numPiloto.find_element(By.TAG_NAME, 'img').get_attribute('src')
                numPilotos_alt = numPiloto.find_element(By.TAG_NAME, 'img').get_attribute('alt')
                writer.writerow([numPo.text.strip(),nombre.text.strip(), apellido.text.strip(), scuderia.text.strip(), punto.text.strip(), imgPaises_alt.strip(), numPilotos_alt.strip(), imgPaises_src.strip(), numPilotos_src.strip()])
            

        print("Datos guardados en 'drivers.csv'")
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

        with open("teams.csv", "w", newline="", encoding="utf-8") as file:
            writer = csv.writer(file, delimiter=';')
            #writer.writerow(["Posición", "Equipo", "Piloto 1", "Piloto 2", "Puntos"])

            for equipo in equipos:
                posicion = equipo.find_element(By.CLASS_NAME, 'f1-heading-black.font-formulaOne.tracking-normal.font-black.non-italic.text-fs-42px.leading-none').text.strip()
                nombre_equipo = equipo.find_element(By.CLASS_NAME, 'f1-inner-wrapper.flex.flex-col.gap-micro.text-brand-black').text.strip()

                pilotos = equipo.find_elements(By.CLASS_NAME, 'f1-team-driver-name')
                if len(pilotos) >= 2:
                    piloto1 = pilotos[0].find_elements(By.CLASS_NAME, 'f1-heading')[1].text.strip()
                    piloto2 = pilotos[1].find_elements(By.CLASS_NAME, 'f1-heading')[1].text.strip()
                    

                puntos = equipo.find_element(By.CLASS_NAME, 'f1-heading-wide.font-formulaOneWide.tracking-normal.font-normal.non-italic.text-fs-18px.leading-none.normal-case').text.strip()
                writer.writerow([posicion, nombre_equipo, piloto1, piloto2, puntos])

        print("Datos guardados en 'teams.csv'")

    except Exception as e:
        print(f"Error: {e}")
    finally:
        driver.quit()




#Scrape headlines using Selenium
#drivers(cnn_url)
teams(teams_url)