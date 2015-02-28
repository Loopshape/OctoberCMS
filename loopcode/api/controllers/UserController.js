/**
 * UserController
 *
 * @description :: Server-side logic for managing users
 * @help        :: See http://links.sailsjs.org/docs/controllers
 */

var passport = require('passport'),
    LocalStrategy = require('passport-local').Strategy,
    bcrypt = require('bcrypt');

module.exports =
{

    login : function(req, res)
    {
        return res.login(
        {
            redirectSuccess : '/member'
        });
    },

    process : function(req, res)
    {
        passport.authenticate('local', function(err, user, info) {
        if( (err)||(!user) ) {
        return res.send({
        message: 'login failed'
        });
        res.send(err);
        }
        req.logIn(user, function(err) {
        if(err)
        res.send(err);
        return res.send({
        message: 'login successful'
        });
        });
        })(req, res);
    },

    logout : function(req, res)
    {
        req.logout();
        return res.redirect('/login');
    },

    signup : function(req, res, next)
    {
        User.create(req.params.all()).exec(function(err, user)
        {
            if (err)
            {
                next(err);
            }
            else
            {
                //res.json(user);
                return res.redirect('/login');
            }
        });
    },

    me : function(req, res)
    {
        res.json(
        {
            username : req.user.name,
            email : req.user.email,
            id : req.user.id
        });
    },
};

