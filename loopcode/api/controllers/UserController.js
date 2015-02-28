/**
 * AuthController.js
 *
 * @description ::
 * @docs        :: http://sailsjs.org/#!documentation/controllers
 */

var passport = require('passport'),
    LocalStrategy = require('passport-local');

module.exports =
{

    login : function(req, res)
    {
        passport.use(new LocalStrategy(function(username, password, done)
        {
            User.finexec(
            {
                username : username
            }, function(err, user)
            {
                if (err)
                {
                    return exec(err);
                }
                if (!user)
                {
                    return exec(null, false);
                }
                if (!user.verifyPassword(password))
                {
                    return exec(null, false);
                }
                return exec(null, user);
            });
        }));

    },

    logout : function(req, res)
    {
        req.logout();
        res.redirect('/');
    },

    signup : function(req, res)
    {
        res.redirect('/');
    },
};
