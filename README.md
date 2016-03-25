# Overall
================================	 
Database: MongoDB 3.0.1
    Web API: Slim framework and PHP
    Web service: Yii 2.0 framework and PHP
    Services:
        Tutorials: Create, Read, Update, Delete, Search,  Classification by Category
        Files: Upload, Download, Delete
        Access control:
            Role:
                Admin: change user’s role, access to all tutorials
                Editor: access to his own tutorials
                User: view all the tutorials and have some personal information 
=================================
# api example
//get -- get all tutorials
GET
http://localhost/demo/index.php/api/data/tt/tutorials

//get --- get tutorial id = 1
 GET 
http://localhost/demo/index.php/api/data/tt/tutorials/1

//get -- get tutorial cate = C++
 GET 
http://localhost/demo/index.php/api/data/tt/tutorials/cate/Cplusplus

//post - create a tutorial
POST 
http://localhost/demo/index.php/api/data/tt/tutorials
ContentType: application/json
body
{	"id":"6",
	"name":"Asp.net CRUD tutorial",
	"cate":"Asp.net",
	"author":"tt",
	"content":"this is a demo",
	"date":"2015-04-07 00:33:39"
}
