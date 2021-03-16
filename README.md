# loginPHP
## データ定義
tableName : users
charset : utf8mb4
| data_name | type          | length | default | auto_increment |
|:--------- |:------------- |:------ | ------- |:-------------- |
| id        | INT(unsigned) | 11     |         | ture           |
| name      | VARCHAR       | 64     |         |                |
| email     | VARCHAR       | 191    |         | unique         |
| password  | VARCHAR       | 191    |         |                |
