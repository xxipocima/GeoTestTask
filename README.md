## Installation
### 1. Clone repository
```bash
git clone https://github.com/xxipocima/GeoTestTask.git
```
### 2. Dependencies installation
Install project dependencies with composer using the following command in the project folder
```bash
composer install
```
### 3. Configuration
Use this command to copy the environment variables settings file.
```bash
.env
```
Then, open .env file and enter your database credentials.

### 4. Run 
```bash
php bin/console doctrine:schema:create
```

### 5. Command to deploy data
```bash
php bin/console app:load-data coordinates_dataset.csv
```
