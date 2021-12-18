# SAW - SEGURANÇA EM APLICAÇÕES WEB

- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## Getting Started

Install a web server such as [Apache](https://www.apache.org/), of course [PHP](https://www.php.net/) and a database as well, such as [MySQL](https://www.mysql.com/).

## Routes

| Endpoint             | Body Request Fields                              | Description          |
| -------------------- | ------------------------------------------------ | -------------------- |
| `GET /homepage`       | { } | Homepage    |
| `POST /homepage?search` | { word: "" }                        | Search bar |
| `POST /homepage` | { name: "", email: "" }                        | Newsletter |
| `POST /signup`       | { } | Sign Up    |
| `POST /signin` | { word: "" }                        | Sign In |
| `POST /signout` | { name: "", email: "" }                        | Sign Out |

## License
[MIT](https://github.com/WallQ/SAW/blob/master/LICENSE)
