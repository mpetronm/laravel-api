
# 1. Configurar Repo API (Directorio actual)
git remote add origin https://github.com/mpetronm/laravel-api.git
# Excluir carpeta infra del repo API
echo "/infra/" >> .gitignore
git add .
git commit -m "Initial API Setup with CI/CD"
# git push -u origin main  <-- El usuario debe ejecutar esto

# 2. Configurar Repo Infra (Subdirectorio infra)
cd infra
git init -b main
git remote add origin https://github.com/mpetronm/laravel-infra.git
git add .
git commit -m "Initial Infra Setup with Ansible"
# git push -u origin main  <-- El usuario debe ejecutar esto
