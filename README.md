## Project: Search VSCode
This is a single-page React application powered by a PHP (Symfony) backend that allows a user to search code on Github within Microsoft's Vscode repository. It features a caching system to prevent user from hitting the [Github API's](https://api.github.com/search/code) rate limit, by returning cached result for already known queries.

### Setup instructions
The entire setup process has been distilled into a single file to make it easy for you to spin up the application and try it out. Run the following command in the project folder (p.s: docker must be installed on your machine):

 ```bash
 chmod u+x setup.sh && ./setup.sh
 ```
- Frontend app will be available at [localhost:8088](http://localhost:8088)
- Backend app will be available at [localhost:8089](http://localhost:8089)

### Screenshots
Results displayed in frontend app
![Results displayed in frontend app](docs/screenshot-1.png)

Message consumer (rabbitmq) responsible for asynchronously logging search history
![Message consumer (rabbitmq) responsible for asynchronously logging search history](docs/screenshot-2.png)

Search history logs stored in sqlite db
![Search history logs stored in sqlite db](docs/screenshot-3.png)
