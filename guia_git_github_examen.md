# Guía rápida de Git, GitHub y terminal — Examen

> **Uso:** busca por `Ctrl + F` el comando, la tarea o el error. Los ejemplos usan `main` como rama principal y `origin` como remoto habitual.
>
> **Alcance:** no se ha podido leer el contenido interno de la carpeta de Drive facilitada; esta guía reúne los comandos habituales para ejercicios de Git/GitHub, pero **no afirma reproducir los comandos del archivo original**.

## 1. Terminal: moverse y preparar archivos

| Comando | Qué hace | Cuándo usarlo |
|---|---|---|
| `pwd` | Muestra la carpeta actual. | Para comprobar dónde estás (Linux/Git Bash). |
| `ls` / `ls -la` | Lista archivos; `-la` incluye ocultos como `.git`. | Para ver el contenido y comprobar si hay repositorio. |
| `cd carpeta` / `cd ..` | Entra en una carpeta / vuelve a la superior. | Para situarte en el proyecto. |
| `mkdir proyecto` | Crea una carpeta. | Antes de iniciar un proyecto nuevo. |
| `touch archivo.txt` | Crea un archivo vacío (Linux/Git Bash). | Para generar archivos de práctica. |
| `cat archivo.txt` | Muestra el contenido de un archivo. | Para comprobarlo desde terminal. |
| `cp origen destino` / `mv origen destino` | Copia / mueve o renombra. | Para organizar archivos. |
| `rm archivo.txt` / `rm -r carpeta` | Borra archivo / carpeta y contenido. | **Con cuidado:** puede eliminar datos sin papelera. |
| `clear` | Limpia la pantalla. | Para despejar la terminal. |

> En **PowerShell** puedes usar `Get-Location`, `Get-ChildItem` y `New-Item` como alternativas; `touch` no es un comando nativo de PowerShell. En Windows, Git Bash permite usar los comandos de estilo Linux de la tabla.

## 2. Git: comandos esenciales

### Configuración e inicio

| Comando | Qué hace | Cuándo usarlo |
|---|---|---|
| `git --version` | Muestra la versión instalada. | Para verificar la instalación. |
| `git config --global user.name "Nombre"` | Configura el autor de los commits. | Al preparar Git en un equipo. |
| `git config --global user.email "correo@ejemplo.com"` | Configura el correo del autor. | Al preparar Git en un equipo. |
| `git config --list` | Muestra la configuración activa. | Si los commits usan un nombre/correo incorrecto. |
| `git init` | Crea un repositorio Git **local**. | Cuando empiezas desde una carpeta existente. |
| `git clone URL` | Descarga un repositorio y configura `origin`. | Cuando el repositorio **ya existe en GitHub**. |
| `git remote -v` | Muestra remotos y direcciones. | Para verificar a qué repositorio se subirá. |
| `git remote add origin URL` | Asocia un remoto llamado `origin`. | Después de `git init` si vas a publicar en GitHub. |
| `git remote set-url origin URL` | Cambia la URL de `origin`. | Si se configuró una URL equivocada. |

### Revisar cambios, guardarlos y consultar historial

| Comando | Qué hace | Cuándo usarlo |
|---|---|---|
| `git status` | Indica rama, cambios y archivos preparados. | **Antes y después** de cada operación importante. |
| `git diff` | Compara cambios no preparados con el índice. | Antes de `git add`. |
| `git diff --staged` | Muestra los cambios preparados. | Antes de `git commit`. |
| `git add archivo.txt` | Prepara un archivo para el próximo commit. | Cuando solo quieres incluir ese archivo. |
| `git add .` | Prepara cambios del directorio actual y subcarpetas. | Para incluir todos los cambios de esa zona; revisa antes. |
| `git commit -m "Descripción"` | Guarda un punto del historial **local**. | Cuando terminas una modificación coherente. |
| `git log --oneline --graph --all --decorate` | Muestra commits y ramas de forma compacta. | Para revisar historial y bifurcaciones. |
| `git show HASH` | Muestra detalles de un commit. | Cuando te piden examinar un cambio anterior. |
| `git ls-files` | Lista archivos bajo seguimiento. | Para comprobar qué archivos controla Git. |

### Ramas, integración y remoto

| Comando | Qué hace | Cuándo usarlo |
|---|---|---|
| `git branch` / `git branch -a` | Lista ramas locales / locales y remotas conocidas. | Para saber qué ramas existen. |
| `git switch -c nueva-rama` | Crea una rama y cambia a ella. | Para desarrollar una funcionalidad aislada. |
| `git switch main` | Cambia a `main`. | Antes de integrar cambios. |
| `git switch rama` | Cambia a una rama existente. | Para retomar trabajo. |
| `git branch -m nuevo-nombre` | Renombra la rama actual. | Para corregir el nombre o usar `main`. |
| `git merge rama` | Integra `rama` en la rama **actual**. | Desde `main` cuando quieres incorporar el trabajo. |
| `git fetch origin` | Descarga referencias/cambios remotos **sin integrarlos**. | Para consultar novedades sin modificar tu rama. |
| `git pull origin main` | Descarga e integra `main` remoto en la rama actual. | Para actualizar `main` local (si estás en `main`). |
| `git push -u origin rama` | Publica la rama y fija seguimiento remoto. | **Primera subida** de esa rama. |
| `git push` | Publica commits de la rama configurada. | Subidas siguientes, si tiene upstream. |
| `git branch -d rama` | Borra una rama local si está integrada. | Después de finalizar y fusionar su trabajo. |
| `git push origin --delete rama` | Borra una rama del remoto. | Si el examen pide limpiar ramas remotas. |

### Deshacer sin perder el control

| Comando | Qué hace | Cuándo usarlo |
|---|---|---|
| `git restore archivo.txt` | Descarta cambios **no preparados** del archivo. | Si no quieres conservar esos cambios. **Destructivo.** |
| `git restore --staged archivo.txt` | Quita el archivo del área de preparación. | Si lo añadiste por error, sin borrar el trabajo. |
| `git commit --amend` | Modifica el último commit local. | Para corregirlo **antes** de publicarlo. |
| `git revert HASH` | Crea un commit que revierte otro. | Para deshacer un commit **ya publicado** sin reescribir historial. |
| `git stash push -m "pendiente"` | Guarda temporalmente cambios locales. | Para cambiar de tarea/rama con trabajo sin terminar. |
| `git stash pop` | Recupera el último conjunto de cambios guardados. | Al volver al trabajo interrumpido. |
| `git reset --hard HASH` | Mueve HEAD e índice y descarta cambios locales. | **Evítalo en examen** salvo petición expresa y seguridad total. |

## 3. Flujo de trabajo: del enunciado a GitHub

### A. Si el repositorio ya existe en GitHub

```bash
git clone URL_DEL_REPOSITORIO
cd nombre-repositorio
git status
git branch -a
```

### B. Si empiezas un proyecto local y debes publicarlo

1. Crea en GitHub un repositorio **vacío** (para evitar conflictos iniciales, sin README si ya tienes archivos locales).
2. Desde la carpeta del proyecto:

```bash
git init
git branch -M main
git add .
git commit -m "Inicio del proyecto"
git remote add origin URL_DEL_REPOSITORIO
git push -u origin main
```

### C. Trabajar en una rama (flujo recomendado)

```bash
git switch main
git pull origin main
git switch -c feature/ejercicio
# Edita los archivos que pida el enunciado
git status
git diff
git add .
git diff --staged
git commit -m "Añade la funcionalidad del ejercicio"
git push -u origin feature/ejercicio
```

### D. Integrar los cambios: elige UNA de estas opciones

**Opción 1 — Pull Request en GitHub (si el examen lo pide):** abre el repositorio en GitHub → **Pull requests** → **New pull request** → base `main` ← compare `feature/ejercicio` → revisa diferencias → **Create pull request** → **Merge** cuando corresponda. Luego actualiza tu equipo:

```bash
git switch main
git pull origin main
```

**Opción 2 — Merge desde terminal (si el examen lo permite):**

```bash
git switch main
git pull origin main
git merge feature/ejercicio
git push origin main
```

**Importante:** un `commit` **no** sube cambios; un `push` **no** crea un Pull Request; un Pull Request permite revisar y proponer la integración de ramas en GitHub.

## 4. Ejercicios más completos: conflictos y colaboración

**Si Git avisa de conflicto durante `merge` o `pull`:**

1. `git status` → localiza los archivos en conflicto.
2. Abre esos archivos y resuelve las marcas `<<<<<<<`, `=======` y `>>>>>>>`.
3. `git add archivo-resuelto` → marca el conflicto como resuelto.
4. En un merge normal, `git commit` → termina la fusión (si Git no la concluyó automáticamente).
5. `git push` → publica el resultado, si corresponde.

**Si necesitas cancelar un merge en curso:** `git merge --abort` (si es posible). No borres las marcas de conflicto sin decidir qué contenido debe conservarse.

**En colaboración:** usa una rama por tarea; haz `git fetch`/`git pull` para recibir cambios; publica tu rama; abre Pull Request y revisa antes de fusionar.

## 5. Errores frecuentes: solución rápida

| Mensaje o problema | Qué significa | Qué hacer |
|---|---|---|
| `not a git repository` | No estás dentro de un repositorio. | `pwd`, `ls -la`; entra en la carpeta correcta o usa `git init` si corresponde. |
| `nothing to commit, working tree clean` | No hay cambios pendientes. | Confirma que has editado y guardado el archivo correcto. |
| `Author identity unknown` | Falta nombre o correo Git. | Configura `git config --global user.name` y `user.email`. |
| `remote origin already exists` | Ya existe un remoto con ese nombre. | `git remote -v`; corrige con `git remote set-url origin URL`. |
| `src refspec main does not match any` | No hay rama/commit local con ese nombre. | Comprueba `git branch` y crea el primer commit antes del push. |
| `rejected (non-fast-forward)` | El remoto tiene cambios no integrados. | `git fetch origin`, revisa e integra con `git pull` según la rama. No fuerces sin permiso. |
| `Permission denied` / HTTP `403` | Problema de acceso, cuenta o credenciales. | Comprueba permisos, URL del remoto y autenticación de GitHub. |
| `CONFLICT (content)` | Cambios incompatibles al integrar. | Resuelve archivos, `git add`, finaliza merge y publica. |
| `Your local changes would be overwritten` | Cambios locales bloquean el cambio/merge. | Haz commit o usa `git stash` antes de continuar. |

## 6. Checklist final del examen

- [ ] Estoy en la carpeta y el repositorio correctos (`pwd`, `git status`).
- [ ] He usado la rama pedida (`git branch`).
- [ ] Los archivos solicitados existen y funcionan.
- [ ] He revisado los cambios (`git diff`, `git diff --staged`).
- [ ] He hecho los commits solicitados (`git log --oneline`).
- [ ] He publicado en la rama correcta (`git remote -v`, `git push`).
- [ ] Si pedían Pull Request, está creado y en el estado solicitado (abierto o fusionado).
- [ ] GitHub muestra los archivos, commits y ramas esperados.

**Regla mental:** `status` → `add` → `commit` → `push` → Pull Request / `merge` (si procede) → verificar.
