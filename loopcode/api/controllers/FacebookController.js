/**
 * UserController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */

var passport = require('passport');

module.exports =
{
	
    'facebook' : function(req, res, next)
    {
        passport.authenticate('facebook', { scope: ['email', 'user_about_me']},
        function (err, user) {
	        req.logIn(user, function (err) {
		        if(err) {
			        req.session.flash = 'There was an error';
			        return res.redirect('/');
		        } else {
			        req.session.user = user;
			        return res.login(
			        {
			            successRedirect : '/member'
			        });
		        }
	        });
        })(req, res, next);
    },

    'facebook/callback' : function(req, res, next)
    {
        passport.authenticate('facebook',
        function (req, res) {
        	return res.login(
	        {
	            successRedirect : '/member'
	        });
        })(req, res, next);
    }
};

