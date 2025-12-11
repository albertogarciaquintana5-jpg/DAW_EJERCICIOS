from django.contrib import admin
from django.urls import path
from HolaMundo import views # Importo nuestro módulo views
urlpatterns = [
path('hola/', views.hola_mundo), #indicamos que la vista la queremos mostrar en esa ruta.
#Si ponemos path('', views.index), no haría falta poner en el navegador el directorio.
path('otramas/', views.home), #nueva vista
path('admin/', admin.site.urls),
]