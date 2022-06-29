# Select Drivers

Clone the project:  
$git clone https://github.com/chrishkv/driver-shipments.git

Enter the path:  
$cd driver-shipments

Run the command:  
$composer install

Copy enviroments variables:  
$cp .env.example .env

Generate key:  
$php artisan key:generate

Generate clases:   
$composer dump-autoload

Then run the command:  
$php artisan serve

Go to the url shown by the terminal  
Looks like: http://127.0.0.1:8000

You must upload 2 text files:  
1 with adress  
1 with drivers

Press the button "Generate"

The result will be displayed on the screen as a table.