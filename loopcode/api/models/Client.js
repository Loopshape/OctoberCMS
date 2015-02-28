/**
 * Client
 *
 * @module      :: Model
 * @description :: oAuth 2 clients
 *
 */

module.exports = {

  attributes: {
  	
  	name: {
  		type: 'STRING',
  		required: true
  	},

  	clientSecret: {
  		type: 'STRING',
  		required: true
  	},

  	redirectURI: {
  		type: 'STRING',
  		required: true
  	},

  	text: {
  		type: 'STRING',
  		required: true
  	}
    
  }

};
