const requireModule = require.context(".", true, /\.js$/); //extract js files inside modules folder
const modules = {};

requireModule.keys().forEach(fileName => {
  if (fileName === "./index.js") return; //reject the index.js file

  const moduleName = fileName.replace(/(\.\/|\.js)/g, "");

  modules[moduleName] = requireModule(fileName).default;
});

export default modules;
