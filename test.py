import keras
from keras.backend import clear_session
import tensorflow as tf
from numba import cuda

cuda.select_device(0)
cuda.close()
clear_session()

with open('model.json', 'r') as json_file:
    loaded_json_file = json_file.read()
    json_file.close()
model = keras.models.model_from_json(loaded_json_file)
model.load_weights('model.h5')



# def predict(image_file):
#     img = image.load_img(image_file, target_size=(299, 299))
#     x = image.img_to_array(img)
#     x = np.expand_dims(x,axis=0)
#     x = preprocess_input(x)
#
#     global graph
#     with graph.as_default():
#         preds = model.predict(x)
#
#     top3 = decode_predictions(preds,top=3)[0]
#
#     predictions = [{'label': label, 'description': description, 'probability': probability * 100.0}
#                     for label,description, probability in top3]
#     return predictions