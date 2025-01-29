# notas sobre las ramas

## Rama backend

Pasos a seguir para actualizar la rama remota de backend

1. Asegúrate de estar en la rama backend

   Primero, verifica que estás trabajando en tu rama backend. En tu terminal, ejecuta:

```bash
git checkout backend
```

2. Confirma que tus cambios están listos para ser enviados
   Asegúrate de haber agregado y confirmado todos los cambios necesarios:

```bash
git add .
git commit -m "Descripción clara de los cambios realizados"
```

3. Sincroniza la rama backend con el remoto
   Antes de subir tus cambios, obtén las actualizaciones remotas para evitar conflictos:

```bash
git pull origin backend
```

4. Sube los cambios a la rama remota backend
   Envía tus cambios al repositorio remoto:

```bash
git push origin backend
```

5. Sincroniza la rama main
   Si deseas actualizar la rama main con los cambios de backend, primero cambia a main:

```bash
git checkout main
```

Luego, combina los cambios desde backend en main:

```bash
git merge backend
```

6. Resuelve conflictos (si los hay)
   Si hay conflictos durante el proceso de fusión, resuélvelos manualmente en los archivos indicados. Una vez resueltos, confirma los cambios:

```bash
git add .
git commit -m "Resueltos conflictos en la fusión de backend en main"
```

7. Sube los cambios a la rama remota main
   Actualiza el repositorio remoto con los cambios de la rama main:

```bash
git push origin main
```
