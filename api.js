// const test = async () => {
//   const res = await fetch('https://test.tenzin.eu/recipe.json');
//   const data = await res.json();
//   const recipes = data.data.find((arr) => arr.name === 'recipes');
//   console.log(recipes);
// };

// test();

fetch('https://test.tenzin.eu/recipe.json')
  .then((res) => res.json())
  .then((data) => {
    const recipes = data.data.find((arr) => arr.name === 'recipes');
    console.log(recipes);
  });

const data = {
  author: 'Kirstin in the Couv',
  cookTime: '20',
  datePublished: '2003-07-30T20:03Z',
  description:
    'This casserole comes from the "Los Barrios Family Cookbook" and although it is tasty with just plain chicken, it is elevated to sublime using Canary Girl\'s Chicken Verde. Just make sure you drain any excess liquid off the chicken. Assemble the dish right before baking -- if you do it in advance, the sauce may make the tortilla strips soggy. You can buy green tomatillo sauce in cans, but I have also posted Los Barrios recipe.',
  id: 71,
  image:
    'https://img.sndimg.com/food/image/upload/q_92,fl_progressive,w_1200,c_scale/v1/img/recipes/67/92/1/D25JJCftTDmV3dBskh9b_chilaquiles3 (1 of 1).jpg',
  name: 'Chilaquiles with Chicken',
  nutritionId: 81,
  rating: 5,
  recipeCategory: 'Chicken',
  recipeIngredient:
    '["2   cups   fried corn tortilla strips (directions follow)","  vegetable oil (for frying)","4   cups   shredded cooked chicken","1 1/2  cups    green tomatillo sauce","1   cup   shredded queso chihuahua cheese or 1   cup    monterey jack cheese","1   cup    sour cream"]',
  recipeInstructions:
    '[{"@type":"HowToStep","text":"Preheat the oven to 350 degrees."},{"@type":"HowToStep","text":"To make the fried tortilla strips, slice corn tortillas into thin strips."},{"@type":"HowToStep","text":"Fry in a large skillet of hot oil until light golden brown and crisp, watching carefully so they do not burn."},{"@type":"HowToStep","text":"Remove with a slotted spoon and drain on paper towels."},{"@type":"HowToStep","text":"To assemble the casserole, spread the corn strips on the bottom of a 9x13\\" baking dish."},{"@type":"HowToStep","text":"Place the chicken on top and cover with the sauce, then top with cheese."},{"@type":"HowToStep","text":"Cover with foil and bake for 20 minutes or until heated through."},{"@type":"HowToStep","text":"Spread the sour cream over the top of the casserole and serve."}]',
  recipeYield: '8 serving(s)',
  reviewCount: 17,
  totalTime: '35',
  url: 'https://www.food.com/recipe/chilaquiles-with-chicken-67921',
};
