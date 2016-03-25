# Overall

* Database: MongoDB 3.0.1
* Web API: Slim framework and PHP
* Web service: Yii 2.0 framework and PHP

## Services:
	Tutorials: Create, Read, Update, Delete, Search,  Classification by Category
	Files: Upload, Download, Delete
	Access control:
	Role:
        	** Admin: change user’s role, access to all tutorials
                ** Editor: access to his own tutorials
                ** User: view all the tutorials and have some personal information 

# api example
//get -- get all tutorials
```html
GET
http://localhost/techtutorial/api/index.php/api/data/tt/Tutorials
```
//get --- get tutorial id = 1
```html
GET 
http://localhost/techtutorial/api/index.php/api/data/tt/Tutorials/1
```
//get -- get tutorial cate = C++
```html
GET 
http://localhost/techtutorial/api/index.php/api/data/tt/Tutorials/cate/Cplusplus
```
//post - create a tutorial
```html
POST 
http://localhost/techtutorial/api/index.php/api/data/tt/Tutorials
ContentType: application/json
body
{	"id":"6",
	"name":"Asp.net CRUD tutorial",
	"cate":"Asp.net",
	"author":"tt",
	"content":"this is a demo",
	"date":"2015-04-07 00:33:39"
}
```
