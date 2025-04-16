import sys
import json
import pickle

# Argumen check: minimal 3 argumen: [index_file] [n] [query ...]
if len(sys.argv) < 4:
    print("\nUsage:\n\tpython query.py [index] [n] [query] ...\n")
    sys.exit(1)


query = [token.lower() for token in sys.argv[3:]]
n = int(sys.argv[2])

with open(sys.argv[1], 'rb') as indexdb:
    indexFile = pickle.load(indexdb)


# query
list_doc = {}
for q in query:
    try:
        for doc in indexFile[q]:
            if doc['TranslatedRecipeName'] in list_doc:
                list_doc[doc['TranslatedRecipeName']]['score'] += doc['score']
            else:
                list_doc[doc['TranslatedRecipeName']] = doc
    except KeyError:
        continue
    

#convert to list
list_data = list(list_doc.values())

#sorting list descending
count = 0
for data in sorted(list_data, key=lambda k: k['score'], reverse=True):
    print(json.dumps(data))
    count += 1
    if count == n:
        break
