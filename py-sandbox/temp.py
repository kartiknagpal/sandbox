import os,sys
#os.chdir('C:\\Users\\Kartik\\Desktop\\py-sandbox\\searchlite')
#sys.path.append(os.getcwd())
from searchlite import *
index = indexer.Index(os.getcwd(),os.getcwd())
search = search.Search(index,'')
print(sys.argv[0])
