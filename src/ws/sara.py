from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import csv
import time

# Configuración de opciones para ejecutar Chrome sin interfaz gráfica
chrome_options = Options()
chrome_options.add_argument("--headless")  # Comentar o eliminar si quieres abrir el navegador
chrome_options.add_argument("--no-sandbox")
chrome_options.add_argument("--disable-dev-shm-usage")

# Crear instancia del navegador
driver = webdriver.Chrome(options=chrome_options)

# Función para esperar a que los elementos estén presentes
def wait_for_elements():
    WebDriverWait(driver, 100).until(
        EC.presence_of_all_elements_located((By.CLASS_NAME, "card.entity-card.entity-card-list.cf"))
    )

# Función para hacer scroll y cargar más elementos (si la página usa scroll infinito)
def scroll_to_load_more():
    body = driver.find_element(By.TAG_NAME, 'body')
    for _ in range(3):  # Hacer scroll varias veces para cargar más contenido
        body.send_keys(Keys.END)
        time.sleep(2)  # Esperar a que cargue más contenido

# Función para extraer títulos, enlaces y URL de imágenes
def extract_data(url, max_pages):
    data = []
    for page in range(1, max_pages + 1):
        # Construir la URL con el número de página
        page_url = f"{url}?page={page}"
        print(f"Accediendo a: {page_url}")
        driver.get(page_url)

        wait_for_elements()  # Esperar a que los elementos estén disponibles
        
        # Hacer scroll para cargar más elementos (si es necesario)
        scroll_to_load_more()

        try:
            # Extraer las tarjetas de contenido
            thumbnails = driver.find_elements(By.CLASS_NAME, "card.entity-card.entity-card-list.cf")
            for thumbnail in thumbnails[:10]:
                title = thumbnail.find_element(By.CLASS_NAME, 'meta-title-link').text.strip()
                link = thumbnail.find_element(By.CLASS_NAME, 'meta-title-link').get_attribute('href')
                img = thumbnail.find_element(By.CLASS_NAME, 'thumbnail-img').get_attribute('src')

                # Verificar y añadir a los datos
                data.append([title, link, img])

        except Exception as e:
            print(f"Error procesando la página {page}: {e}")
            continue

        print(f"Página {page} procesada. Total elementos acumulados: {len(data)}")

    return data

# URL de películas de crímenes
url_peliculas = "https://www.sensacine.com/peliculas/todas-peliculas/genero-13018/"

# Extraer datos de películas (por ejemplo, 5 páginas)
movies_data = extract_data(url_peliculas, 5)

# Verificar que los datos se han extraído correctamente
print(f"Datos de películas extraídos: {movies_data[:10]}")  # Mostrar las primeras 5 películas

# Guardar los datos de películas en un archivo CSV
try:
    with open('scraped_data_peliculas.csv', mode='w', newline='', encoding='utf-8') as file:
        writer = csv.writer(file)
        writer.writerow(['Title', 'Link', 'Image URL'])  # Cabecera
        writer.writerows(movies_data)

    print(f"Total de películas extraídas: {len(movies_data)}")
    print("Datos de películas extraídos y guardados en scraped_data_peliculas.csv")
except Exception as e:
    print(f"Error al guardar los datos: {e}")

# Cerrar el navegador
driver.quit()