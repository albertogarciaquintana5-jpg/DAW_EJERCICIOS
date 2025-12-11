from django.http import HttpResponse #Necesario para poder responde al cliente
from django.shortcuts import render 
#con httpresponde, podemos responder con texto plano o con html
#forma de responder al cliente cuando hace un http
def hola_mundo (request): # El request captura las peticiones de los clientes
 return HttpResponse ("<h1>hola mundo</h1>")

def home (request): # Pinta una página con render, también hay que darlo de alta en urls.py
 return render(request,'index.html')