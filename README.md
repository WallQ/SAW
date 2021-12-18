# SAW - SEGURANÇA EM APLICAÇÕES WEB

- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## Getting Started

Install a web server such as [Apache](https://www.apache.org/), of course [PHP](https://www.php.net/) and a database as well, such as [MySQL](https://www.mysql.com/).

## Routes

### Homepage 
| Endpoint             | Request Fields                              | 
| -------------------- | ------------------------------------------------ |
| `GET /homepage` | { } |
| `POST /homepage:search` | { word } | 
| `POST /homepage` | { name, email } |

### Authentication
| Endpoint             |  Request Fields                              | 
| -------------------- | ------------------------------------------------ |
| `POST /signup` | { firstName, lastName, telephone, gender, state, zipCode, city, email, password, verifyPassword } | 
| `POST /signin` | { email, password } | 
| `GET /signout` | { } | 

### User
| Endpoint             |  Request Fields                              | 
| -------------------- | ------------------------------------------------ |
| `GET /account` | { } | 
| `GET /myproducts` | { } | 
| `POST /sell` | { name, price, description, category_id, user_id, [images] } | 
| `GET /product:id` | { id } | 

## License
[MIT](https://github.com/WallQ/SAW/blob/master/LICENSE)
