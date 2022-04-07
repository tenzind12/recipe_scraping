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

// connection to database established
mysqlConnection.connect((err) => {
  if (err) console.log('failed connection');
  console.log('connection success');
});

// P O S T   F E T C H   A P I
app.post('/recipes/store', (req, res, next) => {
  const reqData = JSON.parse(req.body.resData); // data content

  /* ======= N U T R I T I O N   V A L U E S ======= */
  const nutriData = reqData.nutrition;
  // prettier-ignore
  const nutritionInfo = [nutriData.calories, nutriData.fatContent, nutriData.saturatedFatContent, nutriData.cholesterolContent, nutriData.sodiumContent, nutriData.carbohydrateContent, nutriData.fiberContent, nutriData.sugarContent, nutriData.proteinContent ];

  // 1. inserting into  N U T R I T I O N  - T A B L E first
  mysqlConnection.query(
    'INSERT INTO `nutrition` (`calories`, `fat`, `saturatedFat`, `cholesterol`, `sodium`, `carbohydrate`, `fiber`, `sugar`, `protein`) VALUES (?,?,?,?,?,?,?,?,?)',
    nutritionInfo
  );

  // 2. fetching  N U T R I T I O N  - T A B L E for foreign key
  const test = mysqlConnection.query(
    'SELECT id FROM nutrition ORDER BY id DESC LIMIT 1',
    (err, result, fields) => {
      if (err) throw err;
      const nutriId = result[0].id;

      // 3. inserting to  R E C I P E S - T A B L E  with foreign key (nutrition id)
      // prettier-ignore
      const data = [reqData.author, reqData.name, extractNumber(reqData.cookTime), reqData.datePublished, reqData.description, reqData.image, nutriId, reqData.recipeCategory,reqData.recipeIngredient,reqData.recipeInstructions,reqData.recipeYield,req.body.inputUrl,extractNumber(reqData.totalTime)];
      const jsonData = data.map((el) => (typeof el === 'object' ? JSON.stringify(el) : el));

      mysqlConnection.query(
        'INSERT INTO `recipes`(`author`, `name`, `cookTime`, `datePublished`, `description`, `image`, `nutritionId`, `recipeCategory`, `recipeIngredient`, `recipeInstructions`, `recipeYield`, `url`, `totalTime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        jsonData,
        (err, result, fields) => {
          !err ? res.json(result) : res.json(err);
        }
      );
    }
  );

  // const data = [reqData.author,reqData.name,extractNumber(reqData.cookTime),reqData.datePublished,reqData.description,reqData.image,reqData.nutrition,reqData.recipeCategory,reqData.recipeIngredient,reqData.recipeInstructions,reqData.recipeYield,req.body.inputUrl,extractNumber(reqData.totalTime)];
  // // console.log(data);
  // // converting array and objects to string json
  // const jsonData = data.map((el) => (typeof el === 'object' ? JSON.stringify(el) : el));

  // mysqlConnection.query(
  //   'INSERT INTO `recipes`(`author`, `name`, `cookTime`, `datePublished`, `description`, `image`, `nutrition`, `recipeCategory`, `recipeIngredient`, `recipeInstructions`, `recipeYield`, `url`, `totalTime`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
  //   jsonData,
  //   (err, result, fields) => {
  //     !err ? res.json(result) : res.json(err);
  //   }
  // );
});

app.listen(7000, () => {
  console.log(`Express listening at localhost:7000`);
});

// EXTRACT NUMBER FROM STRING FUNCTION
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
