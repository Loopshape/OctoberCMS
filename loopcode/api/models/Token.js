/**
 * Token
 *
 * @module      :: Model
 * @description :: Access tokens for oAuth 2 clients
 *
 */

module.exports = {

  attributes: {
  	
  	token: {
  		type: 'STRING',
  		required: true
  	},

  	userId: {
  		type: 'INTEGER',
  		required: true
  	},

  	clientId: {
  		type: 'INTEGER',
  		required: true
  	},

  	scope: {
  		type: 'STRING'
  	}
    
  }

};
