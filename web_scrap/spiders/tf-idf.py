import re
import sys
import json
import pickle
import math

# Argumen check
if len(sys.argv) != 3:
    print("\nUsage:\n\tpython tf-idf.py [data.json] [output]\n")
    sys.exit(1)

input_data = sys.argv[1]
output_data = sys.argv[2]

with open(input_data, encoding='utf-8') as f:
    try:
        content = json.load(f)
    except json.JSONDecodeError as e:
        print("Error memuat JSON:", e)
        sys.exit(1)

# ambil data yang diperlukan
required_fields = ['TranslatedRecipeName', 'TranslatedIngredients', 'TotalTimeInMins', "Cuisine", "TranslatedInstructions", "URL", "image-url"]
content = [data for data in content if all(field in data for field in required_fields)]


sw = set(open("stopword.txt", encoding='utf-8').read().splitlines())


def clean_str(text):
    text = (text.encode('ascii', 'ignore')).decode("utf-8")
    text = re.sub("&.*?;", "", text)
    text = re.sub(">", "", text)
    text = re.sub(r"[\]\|\[\@\,\$\%\*\&\\\(\)\":]", "", text)
    text = re.sub("-", " ", text)
    text = re.sub(r"\.+", "", text)
    text = re.sub(r"\d+", "", text)
    text = re.sub(r"^\s+", "", text)
    text = text.lower()
    return text


df_data = {}
tf_data = {}
idf_data = {}


for i, data in enumerate(content):
    tf = {}
    #clean and list word
    clean_name = clean_str(data['TranslatedRecipeName'])
    list_word = clean_name.split()

    for word in list_word:
        if word in sw:
            continue

        #tf term frequency
        if word in tf:
            tf[word] += 1
        else:
            tf[word] = 1

        #df document frequency
        if word in df_data:
            df_data[word] += 1
        else:
            df_data[word] = 1

    tf_data[i] = tf  # index sebagai ID unik dokumen

# Hitung IDF
total_docs = len(tf_data)
for word, df in df_data.items():
    idf_data[word] = 1 + math.log10(total_docs / df)

tf_idf = {}

for word in df_data:
    list_doc = []
    for i, data in enumerate(content):
        tf_value = tf_data[i].get(word, 0)

        weight = tf_value * idf_data[word]

        if weight == 0:
            continue

        doc = {
            'id': i,
            'TranslatedRecipeName': data['TranslatedRecipeName'],
            'TranslatedIngredients': data['TranslatedIngredients'],
            'TotalTimeInMins': data['TotalTimeInMins'],
            'Cuisine': data['Cuisine'],
            'TranslatedInstructions': data['TranslatedInstructions'],
            'URL': data['URL'],
            'image-url': data['image-url'],
            'score': weight
        }
        list_doc.append(doc)

    tf_idf[word] = list_doc

# Write dictionary to file
with open(output_data, 'wb') as file:
    pickle.dump(tf_idf, file)
