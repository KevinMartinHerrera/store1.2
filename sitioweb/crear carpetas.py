import os

ubicacion = "D:/xaampp/htdocs/sitioweb/images/products" #Cambiar por la ubicación que desees

for i in range(8, 101):
    nombre_carpeta = str(i)
    ruta_carpeta = os.path.join(ubicacion, nombre_carpeta)
    try:
        os.mkdir(ruta_carpeta)
        print("Carpeta " + nombre_carpeta + " creada exitosamente!")
    except OSError as error:
        print(error)
