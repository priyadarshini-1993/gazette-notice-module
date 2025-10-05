### Gazette Notice Module — Drupal-style Feed Integration (Yii2)

This project demonstrates a custom Yii2 module that consumes The Gazette REST API and displays published notices in a clean, paginated frontend interface.


### Features

* Fetches notices dynamically from The Gazette REST API
* Displays:

  * Notice title (linked to the original Gazette notice)
  * Publish date (formatted as “1 October 2021”)
  * Content (HTML rendered safely)
* Pagination: 10 results per page using Yii2’s `Pagination`
* Semantic, accessible HTML5 markup
* Styled with custom CSS (`notice.css`)


### Project Setup

1. Clone the repository

   git clone https://github.com/priyadarshini-1993/gazette-notice-module.git
   cd gazette-notice-module


2. Install dependencies

   composer install


3. Run local server

   1. From PHP built-in server

       php yii serve --docroot="frontend/web" --port=8080

       http://localhost:8080/notice

    2. From Apache2
      
      * Edit your Apache virtual host config (/etc/apache2/sites-available/williams-lea.conf):

      <VirtualHost *:80>
            ServerName williams-lea.local
            DocumentRoot /var/www/html/williams-lea-project/frontend/web

        <Directory /var/www/html/williams-lea-project/frontend/web>
            AllowOverride All
            Require all granted
        </Directory>

            ErrorLog ${APACHE_LOG_DIR}/williams-lea-error.log
            CustomLog ${APACHE_LOG_DIR}/williams-lea-access.log combined
      </VirtualHost>

      * Restart the server
      
      sudo systemctl restart apache2

      http://williams-lea.local/notice


### Important Files

 `common/services/GazetteService.php`        =>  Handles API requests to The Gazette REST endpoint, decodes JSON data, and formats notice fields.  
 `frontend/controllers/NoticeController.php` =>  Controller that calls the `GazetteService` and passes data to the view with pagination.           
 `frontend/views/notice/index.php`           =>  Renders the list of Gazette notices in accessible HTML5 with links, dates, and formatted content. 
 `frontend/web/css/notice.css`               =>  Custom stylesheet for layout and typography of the Gazette notices.                               
 `frontend/config/main.php`                  =>  Includes the route configuration for the notice module and registers assets if needed.            
 `composer.json`                             =>  Lists all project dependencies and autoload configurations.                                       


### Technical Highlights

* Uses Yii2 MVC structure and `ActiveDataProvider`-style pagination.
* Uses Yii2’s `formatter->asRaw()` to render safe HTML content from API.
* Includes custom styling via `notice.css` to ensure clean, readable layout.
* Code structured to be easily extended into a reusable module or widget.


### How to Test

You’ll see a list of 10 notices with:

   * Titles linking to Gazette
   * Formatted dates
   * Full content body
   * Pagination at the bottom

### Author

Priyadarshini G

mailto: darshini.uma07@gmail.com
GitHub: https://github.com/priyadarshini-1993

