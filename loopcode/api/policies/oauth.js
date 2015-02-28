/**
* oAuth 2 token policy
**/
var passport = require('passport');

module.exports = function(req,res,next) {
	passport.authenticate(
	    'bearer',
	    function(err, user, info)
	    {
	        if ((err) || (!user))
	        {
	            res.redirect('/');
	            return;
	        }
            delete req.query.access_token;
	        req.user = user;
	        return next();
	    }
	)(req, res);
};