const test = async () => {
  const res = await fetch('https://test.tenzin.eu/recipe.json');
  const data = await res.json();
  const recipes = data.data.find((arr) => arr.name === 'recipes');
  console.log(recipes);
};

test();
