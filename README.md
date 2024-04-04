# Project: The Food Depot 


# package management
 - in root folder, to install php modules:
composer install
 - in api_server, to install node modules:
npm i


## Database Configuration and Setup:

### Requirements
- MySQL

### Environment Setup
1. Rename .env.example file to .env
- If you haven't already done so, locate the .env.example file in your project directory and rename it to .env.

2. Update Environment Variables
- Open the .env file in a text editor
- update env values present in .env to match your local DB configuration.

# Database Configuration
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=myapp_development
   DB_USERNAME=myapp_user
   DB_PASSWORD=myapp_password

## Version Control and Security
- Developers are reminded not to commit sensitive information, such as database credentials, to version control systems like Git Keeping sensitive data secure is essential for maintaining the integrity and security of our project.

