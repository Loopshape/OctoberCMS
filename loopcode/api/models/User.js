/**
 * User.js
 *
 * @description :: TODO: You might write a short summary of how this model works and what it represents here.
 * @docs        :: http://sailsjs.org/#!documentation/models
 */

module.exports =
{

    schema : 'true',

    attributes :
    {

        /*
         * LOCAL STRATEGY
         */
        id :
        {
            type : 'integer',
            unique : true
        },
        
        username :
        {
            type : 'string',
            unique : true,
            required : true
        },

        password :
        {
            type : 'string',
            required : true,
            minLength : 4
        },

        /*
         * FACEBOOK
         */
        facebookId :
        {
            type : 'string',
            required : true,
            unique : true
        },

        /*
         beforeCreate : function(attrs, next)
         {
         var bcrypt = require('bcrypt');

         bcrypt.genSalt(10, function(err, salt)
         {
         if (err)
         return next(err);

         bcrypt.hash(attrs.password, salt, function(err, hash)
         {
         if (err)
         return next(err);

         attrs.password = hash;
         next();
         });
         });
         },
         */

    },
    
    autoPK: false

};

