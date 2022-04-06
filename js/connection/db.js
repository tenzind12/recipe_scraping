// import { extractNumber } from '../services/helper';
const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();

app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

const mysqlConnection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'recipe',
  multipleStatements: true,
});

mysqlConnection.connect((err) => {
  if (err) console.log('failed connection');
  console.log('connection success');
});

app.post('/recipes/store', (req, res, next) => {
  console.log(req.body);
  const reqData = JSON.parse(req.body.resData);

  // extracting numbers from string
  const extractNumber = (str) => {
    const nums = '1234567890';
    let result = '';

    for (let i = 0; i < str.length; i++) {
      for (let j = 0; j < nums.length; j++) {
        if (str[i] == nums[j]) {
          result += str[i];
        }
      }
    }
    return result;
  };

  // prettier-ignore
  const data = [reqData.author,reqData.name,extractNumber(reqData.cookTime),reqData.datePublished,reqData.description,reqData.image,reqData.nutrition,reqData.recipeCategory,reqData.recipeIngredient,reqData.recipeInstructions,reqData.recipeYield,req.body.inputUrl,extractNumber(reqData.totalTime)];
  console.log(data);
  // converting array and objects to string json
  const jsonData = data.map((el) => (typeof el === 'object' ? JSON.stringify(el) : el));

  mysqlConnection.query(
    'INSERT INTO `recipes`(`author`, `name`, `cookTime`, `datePublished`, `description`, `image`, `nutrition`, `recipeCategory`, `recipeIngredient`, `recipeInstructions`, `recipeYield`, `url`, `totalTime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
    jsonData,
    (err, result, fields) => {
      !err ? res.json(result) : res.json(err);
    }
  );
});

app.listen(7000, () => {
  console.log(`Express listening at localhost:7000`);
});
