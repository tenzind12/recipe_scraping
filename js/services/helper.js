// extract number from string
export const extractNumber = (str) => {
  const nums = '1234567890';
  let result = '';

  for (let i = 0; i < str.length; i++) {
    for (let j = 0; j < nums.length; j++) {
      if (str[i] == nums[j]) {
        result += str[i];
      }
    }
  }
};
