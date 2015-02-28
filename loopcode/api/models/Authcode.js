/**
 * Authcode
 *
 * @module      :: Model
 * @description :: A short summary of how this model works and what it represents.
 *
 */

module.exports = {

  attributes: {
  	
  	code: {
  		type: 'STRING',
  		required: true
  	},

  	clientId: {
  		type: 'INTEGER',
  		required: true,
  	},

  	userId: {
  		type: 'INTEGER',
  		required: true
  	},

  	redirectURI: {
  		type: 'STRING',
  		required: true
  	},

  	scope: {
  		type: 'STRING'
  	}

  }

};
