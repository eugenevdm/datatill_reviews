# DataTill Reviews WordPress Widget

## Description

A WordPress widget that allows you to publish customer ratings to your website

## Installation

Copy all files into `wordpress_installation/wp-content/plugins/`

When you're done you'll have

`wordpress_installation/wp-content/plugins/datatill_reviews`

Run `composer install` from the above folder to install Carbon

## Configuration

Go to Settings / DataTill Reviews

* Add your DataTill host, database name, database username, and database password
* Set minimum rating to 5 or less
* Set maximum results to 1 or more

For support, email eugene@herotel.com or call +27 82 309-6710.

## Troubleshooting

Most WordPress installations are on different hosts than DataTill installations.

Run this command on the DataTill server to allow remote access from the WordPress instance:

Go to terminal

mysql -uroot -p

`grant all privileges on datatill.* to 'user'@'wordpress_host_ip' identified by 'password' with grant option;`
