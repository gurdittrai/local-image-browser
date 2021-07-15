import os
import numpy as np
import random
from PIL import Image, ImageDraw
# from random import randrange


size = [640, 480, 800, 600, 960, 720, 1024, 768, 1280, 960, 1400,
        1050, 1440, 1080, 1600, 1200, 1856, 1392, 1920, 1440,  2048, 1536]
colour = [
    [0, 0, 0],
    [0, 0, 128],
    [0, 128, 0],
    [128, 0, 0],
    [153, 153, 255],
    [153, 51, 102],
    [153, 204, 0],
    [255, 255, 102],
    [0, 102, 204],
]

random_words = {
    "adj":
        ["hysterical", "dapper", "foregoing",
         "interesting", "parched", "eager",
         "squalid", "wary", "hellish",
         "misty", "flat", "wooden",
         "amazing", "curious", "minor",
         "sloppy", "seemly", "like",
         "dangerous", "six", "lopsided"],
    "noun":
        ["bell", "match", "dime",
         "name", "statement", "look",
         "pear", "base", "jail",
         "birds", "jewel", "clam",
         "visitor", "square", "secretary",
         "donkey", "pollution", "humor",
         "effect", "door", "collar"]

}


def create_pixel():
    return np.random.randint(0, high=255, size=(3, 3, 3), dtype=np.uint8)


def resize_image(pix):
    # random sizes
    x = size[random.randrange(len(size))]
    y = size[random.randrange(len(size))]
    res = np.resize(pix, (x, y, 3))
    # draw_shape(res, x, y)
    return res.real.astype(dtype=np.uint8, subok=False)


def draw_shape(image, width, height):
    # coords
    x = random.randrange(start=2*width/10, stop=8*width/10)
    y = random.randrange(start=2*height/10, stop=8*height/10)
    draw = ImageDraw.Draw(image)
    draw.rectangle((200, 100, width/4, height/4),
                   fill="red", outline="black", width=3)


def random_image():
    pix = create_pixel()
    res = resize_image(pix)
    return res


def make_test_images(i, loc):
    image = random_image()
    Image.fromarray(image).save(f"{loc}/res{i}.jpeg")


def create_dir(loc):
    if (os.path.exists(loc)):
        print(f"{loc} directory exists")
    else:
        try:
            os.makedirs(loc)
        except OSError:
            print("creation of the directory %s failed" % loc)
        else:
            print("directory created")


def create_images(n, loc):
    for i in range(n):
        # create sub directory
        folder = random.choice(random_words["adj"]) + " " + random.choice(random_words["noun"])
        subdir = f"{loc}/{folder}"
        create_dir(subdir)
        # populate sub directory
        for j in range(random.randrange(start=24, stop=45)):
            make_test_images(j, subdir)


loc = "./assets"
create_images(10, loc)
