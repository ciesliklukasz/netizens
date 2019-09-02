#Netizens project

Require:
- `composer global require laravel/installer`
- run `php composer.phar install`
- create `database.sqlite` in database dir
- run `php artisan migrate migrate:fresh`

#Use app
- picture:
	- `php artisan picture:import` import all pictures and if exists overwrite
		- `--overvrite` - overwrite pictures
		- `--only_new` - import only new or changed pictures
	- `php artisan picture:update {pictureId}` - update picture with values:
		- `--title=` - update title
		- `--author=` - update author
		- `--description=` - update description
		
- album:
	- `php artisan album:delete {albumId}` - delete album with pictures
	- `php artisan album:delete_pictures {albumId}` - delete all pictures from album
	- `php artisan album:show  {albumId}` - show album with related pictures
	- `php artisan album:update {albumId}` - update album with values:
		- `--name=` - update name
		
#API
Run `php artisan serve` to create server. By default `http://127.0.0.1:8000`
- `/api/pictures` - return json with all pictures
	
