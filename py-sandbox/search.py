import sys
import indexer

def search_index(word):
	'''search_index(word) - Takes a string word as a argument
		return a list of queried paths'''
	return indexer.search(word)


#for each word in cmd-line arg, enquiry index and get the path-list, create a dictionary 
#containing each path to its occurrence count overall
path_count_dict = {}

for i in range(0,len(needle_list)):


	#get list of path for a word
	path_list = search_index(word)	

	#populate dict with path and its count
	for path in path_list:
		try:
			path_count_dict[path] += 1
		except KeyError:
			path_count_dict[path] = 1
