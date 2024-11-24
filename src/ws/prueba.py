from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import time
import csv

#URL of CNN's homepage
cnn_url = "https://www.formula1.com/en/drivers"

#Function to scrape headlines using Selenium
def scrape_with_selenium(url):
    options = Options()
    options.headless = False  # Set to True for headless mode
    driver = webdriver.Chrome(options=options)

    #Navigate to the webpage
    driver.get(url)

    #Interact with the webpage using Selenium
    # Example: Click on a button that loads more articles

    #species_list = driver.find_element(By.CLASS_NAME, 'speciesList')
    #species_list = driver.find_element(By.CLASS_NAME, 'f1-container')

    #all_species = species_list.find_elements(By.CLASS_NAME, 'speciesNewRow')
    #all_species = species_list.find_elements(By.CLASS_NAME, 'group')

    #for specie in all_species:
    #    print(specie.find_element(By.CLASS_NAME, 'speciesTitle').text)
    #    print(specie.find_element(By.CLASS_NAME, 'speciesTitle').get_attribute('href'))

    # FUNCIONA CORRECTAMENTE
    try:
        nombres = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-12px.leading-tight.uppercase.font-normal.non-italic.f1-heading__body.font-formulaOne')
        apellidos = driver.find_elements(By.CLASS_NAME, 'f1-heading.tracking-normal.text-fs-18px.leading-tight.uppercase.font-bold.non-italic.f1-heading__body.font-formulaOne')

        with open("drivers.csv", "w", newline="", encoding="utf-8") as file:
            writer = csv.writer(file, delimiter=';')  # Usa ';' como separador
            writer.writerow(["nombre", "apellido"])  # Cabecera
            for nombre, apellido in zip(nombres, apellidos):
                writer.writerow([nombre.text.strip(), apellido.text.strip()])
            

        print("Datos guardados en 'drivers.csv'")
    except Exception as e:
        print(f"Error: {e}")
    finally:
        # Cerrar el navegador
        driver.quit()

    #cookies_button = driver.find_element(By.ID, 'onetrust-accept-btn-handler')
    #cookies_button.click();

    ## no_of_jobs = int(wd.find_element(By.CSS_SELECTOR, 'h1>span'))
    ## load_more_button = driver.find_element_by_css_selector('.load-more-button')
    ## load_more_button = driver.find_element(By.CSS_SELECTOR, '.load-more-button')
    ## load_more_button.click()

    #Allow time for dynamic content to load (you may need to use WebDriverWait for more robust waiting)
    #time.sleep(3)

    #Extract and print headlines after loading more content
    ## headlines = driver.find_elements_by_css_selector('.card h3')
    #headlines = driver.find_elements(By.TAG_NAME, 'h2')
    #for headline in headlines:
    #    print(headline.text)

    #Close the browser window

#Scrape headlines using Selenium
scrape_with_selenium(cnn_url)