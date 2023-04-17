# Unity Remote Scoreboard

This is a basic example of how to do a simple scoreboard in Unity. How you decide to show the scores in game is your choice, this example will help you to grab and uplaod content from a remote server.
Remote server files are writen in PHP 8.0.

## Content

- "Remote server files" folder has all the necessary files that should be uploaded to your server.
- "Unity scripts" has all the C# files that you should include in your Unity project.

## How to install

Clone this repository in your PC.

###### In Unity:

1. Add the `Unity scripts` files inside your Unity project.
2. Open the `ServerRequest.cs` file and locate the `server_url` private variable and add your URL there.

###### In your web server:

You can use any free hosting to create a remote server, for example [000webhost](https://www.000webhost.com/).

1. Upload the "Remote server" files to the "public_html" folder of your web server `except for the users_score.sql` file. 
2. Create a database and name it however you want.
3. Access the database and import the `users_score.sql` file, a new table should be created.
4. Inside your `public_html/settings` folder there should be a file called `database.php`, open it and add your database credentials.
