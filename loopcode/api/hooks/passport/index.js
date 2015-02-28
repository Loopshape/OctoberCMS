/**
 * Module dependencies
 */

var Passport = require('passport').constructor;



/**
 * Passport  hook
 */

module.exports = function (sails) {

  return {

    defaults: {
      passport: {
        // Default to look for a model w/ identity 'user'
        userModelIdentity: 'user'
      }
    },

    initialize: function (cb) {
      var err;

      // Validate `userModelIdentity` config
      if (typeof sails.config.passport.userModelIdentity !== 'string') {
        sails.config.passport.userModelIdentity = 'user';
      }
      sails.config.passport.userModelIdentity = sails.config.passport.userModelIdentity.toLowerCase();



      // We must wait for the `orm` hook before acquiring our user model from `sails.models`
      // because it might not be ready yet.
      if (!sails.hooks.orm) {
        err = new Error();
        err.code = 'E_HOOK_INITIALIZE';
        err.name = 'Passport Hook Error';
        err.message = 'The "passport" hook depends on the "orm" hook- cannot load the "passport" hook without it!';
        return cb(err);
      }
      sails.after('hook:orm:loaded', function (){

        // Look up configured user model
        var UserModel = sails.models[sails.config.passport.userModelIdentity];

        if (!UserModel) {
          err = new Error();
          err.code = 'E_HOOK_INITIALIZE';
          err.name = 'Passport Hook Error';
          err.message = 'Could not load the passport hook because `sails.config.passport.userModelIdentity` refers to an unknown model: "'+sails.config.passport.userModelIdentity+'".';
          if (sails.config.passport.userModelIdentity === 'user') {
            err.message += '\nThis option defaults to `user` if unspecified or invalid- maybe you need to set or correct it?';
          }
          return cb(err);
        }

        // Create a passport instance to use
        sails.passport = new Passport();

        // Teach our Passport how to serialize/dehydrate a user object into an id
        sails.passport.serializeUser(function(user, done) {
          console.log('Using primary key', UserModel.primaryKey, 'with record:',user);
          done(null, user[UserModel.primaryKey]);
        });

        // Teach our Passport how to deserialize/hydrate an id back into a user object
        sails.passport.deserializeUser(function(id, done) {
          UserModel.findOne(id, function(err, user) {
            done(err, user);
          });
        });

        // It's very important to trigger this callback method when you are finished
        // with the bootstrap!  (otherwise your server will never lift, since it's waiting on the bootstrap)
        cb();

      });

    },

    routes:{
      before: {
        '/*': function configurePassport(req, res, next) {
          req = _extendReq(req);
          sails.passport.initialize()(req,res,function(err){
            if (err) return res.negotiate(err);
            sails.passport.session()(req,res, function (err){
              if (err) return res.negotiate(err);
              next();
            });
          });
        }
      }
    }
  };
};






/**
 * Normally these methods are added to the global HTTP IncomingMessage
 * prototype, which breaks encapsulation of Passport core.
 * This function is a patch to override this and also attach them to the local req/res.
 * This allows these methods to work for incoming socket requests.
 * @param  {[type]} req [description]
 * @return {[type]}     [description]
 */
function _extendReq(req) {

  /**
   * Intiate a login session for `user`.
   *
   * Options:
   *   - `session`  Save login state in session, defaults to _true_
   *
   * Examples:
   *
   *     req.logIn(user, { session: false });
   *
   *     req.logIn(user, function(err) {
   *       if (err) { throw err; }
   *       // session saved
   *     });
   *
   * @param {User} user
   * @param {Object} options
   * @param {Function} done
   * @api public
   */
  req.login =
  req.logIn = function(user, options, done) {
    if (typeof options == 'function') {
      done = options;
      options = {};
    }
    options = options || {};

    var property = 'user';
    if (req._passport && req._passport.instance) {
      property = req._passport.instance._userProperty || 'user';
    }
    var session = (options.session === undefined) ? true : options.session;

    req[property] = user;
    if (!session) return done&&done();
    if (!req._passport) { throw new Error('passport.initialize() middleware not in use'); }
    if (typeof done != 'function') { throw new Error('req#login requires a callback function'); }

    req._passport.instance.serializeUser(user, req, function(err, obj) {
      if (err) {
        req[property] = null;
        return done(err);
      }
      req._passport.session.user = obj;
      done();
    });
  };

  /**
   * Terminate an existing login session.
   *
   * @api public
   */
  req.logout =
  req.logOut = function() {
    var property = 'user';
    if (req._passport && req._passport.instance) {
      property = req._passport.instance._userProperty || 'user';
    }

    req[property] = null;
    if (req._passport && req._passport.session) {
      delete req._passport.session.user;
    }
  };

  /**
   * Test if request is authenticated.
   *
   * @return {Boolean}
   * @api public
   */
  req.isAuthenticated = function() {
    var property = 'user';
    if (req._passport && req._passport.instance) {
      property = req._passport.instance._userProperty || 'user';
    }

    return (req[property]) ? true : false;
  };

  /**
   * Test if request is unauthenticated.
   *
   * @return {Boolean}
   * @api public
   */
  req.isUnauthenticated = function() {
    return !req.isAuthenticated();
  };

  return req;
}
