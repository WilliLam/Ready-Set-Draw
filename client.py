import cv2
import keras as k
import numpy as np
import sys

labelsToIndex = {'bird':0, 'cannon':1, 'chandelier':2, 'horse':3,
        'hot_dog':4, 'panda':5, 'windmill':6}

path = sys.argv[1]

img = cv2.imread(path)
img = cv2.resize(img, dsize=(28, 28))
img = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
cv2.imwrite('panda-f.jpeg', img)
img = np.array(img)
img = np.reshape(img, newshape=(1, 784))
img = np.divide(img, 255)

with open('model.json', 'r') as json_file:
    loaded_json = json_file.read()
    model = k.models.model_from_json(loaded_json)
    model.load_weights('model.h5')

prediction = model.predict(img)
print(prediction)
print(type(prediction))
for key in labelsToIndex.keys():
    print(key + ' : ' + str(prediction[0][labelsToIndex[key]] * 100) + '%')