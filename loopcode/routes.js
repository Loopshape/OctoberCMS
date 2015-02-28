module.exports.routes = {

  '/': { view: 'homepage' },
  'get /login': { view: 'user/login' },
  'get /signup': { view: 'user/signup' },
  '/member': { view: 'user/member' },
  'post /login': 'UserController.login',
  'post /signup': 'UserController.signup',
  '/logout': 'UserController.logout',
  
  '/facebook': 'FacebookController.login',
  
};
