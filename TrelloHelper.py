import urllib.parse
import pycurl

class TrelloHelper():
	"""Classe permettant d'intéragir avec l'API de Trello."""

	def __init__(self, key, token):
		self.key = key
		self.token = token

	def get_lists(self, id_board):
		c = pycurl.Curl()
		c.setopt(c.URL, 'https://trello.com/1/board/' + id_board + '/lists?key=' + self.key + '&token=' + self.token + '&cards=open')
		c.perform()
		c.close()

	def get_members_board(self, id_board):
		c = pycurl.Curl()
		c.setopt(c.URL, 'https://trello.com/1/board/' + id_board + '/members?key=' + self.key + '&token=' + self.token + '&cards=open')
		c.perform()
		c.close()

	def add_card_to_list(self, id_list, name='', desc='', due='', labels='', id_member=''):
		data = {
			'idList': id_list,
			'name': name,
			'desc': desc,
			'labels': labels,
			'idMembers': id_member,
			'due': due
		}

		c = pycurl.Curl()
		c.setopt(c.URL, 'https://trello.com/1/card?key=' + self.key + '&token=' + self.token + '&cards=open')
		c.setopt(c.POSTFIELDS, urllib.parse.urlencode(data))
		c.perform()
		c.close()
