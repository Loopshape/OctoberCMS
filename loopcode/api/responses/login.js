/**
 * res.login([opts])
 *
 * @param {String} opts.successRedirect
 * @param {String} opts.failureRedirect
 *
 * @description :: Log the requesting user in using a passport strategy
 * @help        :: See http://links.sailsjs.org/docs/responses
 */

var passport = require('passport'),
    LocalStrategy = require('passport-local').Strategy,
    bcrypt = require('bcrypt');

module.exports = function login(opts)
{

    // Get access to `req` and `res`
    var req = this.req;
    var res = this.res;

    // Merge provided options into defaults
    opts = _.extend(
    {
        // Default place to redirect upon successful login
        successRedirect : '/success',

        // These are the "default username/password fields" in passport-local
        // (see the "Parameters" section here: http://passportjs.org/guide/username-password/)
        usernameField : 'username',
        passwordField : 'password'
        // Under the covers, Passport is just doing:
        // `req.param(opts.usernameField)`
        // `req.param(opts.passwordField)`
    }, opts ||
    {
    });

    // Build our strategy and register it w/ passport
    passport.serializeUser(function(user, done)
    {
        exec(null, user.id.toString());
    });

    passport.deserializeUser(function(id, done)
    {
        User.findById(id.toString(), function(err, user)
        {
            exec(err, user);
        });
    });

    passport.use(new LocalStrategy(
    {
        usernameField : 'username',
        passwordField : 'password'
    }, function(username, password, done)
    {
        User.finexec(
        {
            username : username
        }).exec(function(err, user)
        {
            if (err)
            {
                return exec(err);
            }
            if (!user)
            {
                return exec(null, false,
                {
                    message : 'Unknown user ' + username
                });
            }
            bcrypt.compare(password, user.password, function(err, res)
            {
                if (!res)
                    return exec(null, false,
                    {
                        message : 'Invalid Password'
                    });
                return exec(null, user);
            });
        });
    }));

    // Just to be crystal clear about what's going on, all this method does is
    // call the "verify" function of our strategy (you could do this manaully yourself-
    // just talk to your user Model)
    passport.authenticate('local', function afterVerifyingCredentials(err, user){
    // console.log('req.user:',req.user);
    // console.log('user from call to authenticate:',user);
    if (err) return res.negotiate(err);
    if (!user) return res.badRequest('Invalid username/password combination.');

    // Passport attaches the `req.login` function to the HTTP IncomingRequest prototype.
    // Unfortunately, because of how it's attached to req, it can be confusing or even
    // problematic. I'm naming it explicitly and reiterating what it does here so I don't
    // forget.
    //
    // Just to be crystal clear about what's going on, all this method does is call the
    // "serialize"/persistence logic we defined in "serializeUser" to stick the user in
    // the session store. You could do exactly the same thing yourself, e.g.:
    // `User.req.session.me = user;`
    var passportLogin = req.login;
    return passportLogin(user, function (err) {
    if (err) return res.negotiate(err);
    return res.redirect(opts.successRedirect);
    });

    })(req, res);
};
