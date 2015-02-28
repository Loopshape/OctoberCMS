/**
 * User
 *
 * @module   :: Model
 * @description :: A short summary of how this model works and what it represents.
 *
 */
var bcrypt = require('bcrypt');

module.exports =
{

    schema : true,

    autoPK : false,
    autoCreatedAt : false,
    autoUpdatedAt : false,

    table : 'user',
    attributes :
    {
        id :
        {
            type : 'integer',
            index : true,
            required : true,
            unique : true
        },
        username :
        {
            type : 'string',
            required : true,
            unique : true
        },
        password :
        {
            type : 'string',
            minLength : 4,
            required : true
        },
        email :
        {
            type : 'email',
            required : true,
            unique : true
        },
        toJSON : function()
        {
            var obj = this.toObject();
            delete obj.password;
            return obj;
        }
    },

    // Lifecycle Callbacks
    /*
     beforeCreate : function(values, next)
     {
     next();
     },
     */
    beforeCreate : function(user, cb)
    {
        bcrypt.genSalt(10, function(err, salt)
        {
            bcrypt.hash(user.password, salt, function(err, hash)
            {
                if (err)
                {
                    console.log(err);
                    cb(err);
                }
                else
                {
                    user.password = hash;
                    console.log(hash);
                    cb(null, user);
                }
            });
        });
    },
};
