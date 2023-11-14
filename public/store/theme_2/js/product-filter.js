function getKeys(products) {

    // Return sorted list of unique product keys.

    const getProductKeys = (product) => _.keys(product.attributes);
    const productKeys = _.flatMap(products, getProductKeys);
    return _.sortBy(_.uniq(productKeys));
}

function getProperties(products, keys) {

    // Return product property vectors.

    const properties = _.map(products, (product) => {
        return _.map(keys, (key) => product.attributes[key]);
    });
    return properties;
}

function elemProduct(arr1, arr2) {

    // Calculate element-wise product of two arrays.

    return _.zipWith(arr1, arr2, (elem1, elem2) => elem1 == elem2);
}

function dotProduct(arr1, arr2) {

    // Calculate dot product of two arrays.

    return _.reduce(elemProduct(arr1, arr2), (sum, elem) => {
        return sum + (elem ? 1 : 0);
    });
}

function getNeighbours(collection, item) {

    // Return vectors in `collection` that are neighbours to vector `item`.

    function areNeighbours(arr1, arr2) {
        return dotProduct(arr1, arr2) == (arr1.length - 1);
    }

    return _.filter(collection, (other) => areNeighbours(item, other));
}

function slice(collection, n) {

    // Return list of nth elements in list of lists `collection`.

    const values = _.map(collection, (prop) => prop[n]);
    return _.sortBy(_.uniq(values));
}

function inside(collection, item) {

    // Determine if `item` is in `collection`.

    return collection.indexOf(item) != -1;
}

function getSelectors(products, selectedProduct) {

    "use strict";

    const selectedIndex = products.indexOf(selectedProduct);

    const keys = getKeys(products);
    const properties = getProperties(products, keys);
    const neighbours = getNeighbours(properties, properties[selectedIndex]);
    const selected = [properties[selectedIndex]];

    const valueGroups = _.map(keys, (key, index) => {

        const valuesAll = slice(properties, index);
        const valuesSelected = slice(selected, index);
        const valuesNeighbours = slice(neighbours, index);

        function getValueState(value) {
            if (inside(valuesSelected, value)) return "selected";
            if (inside(valuesNeighbours, value)) return "enabled";
            else return "disabled";
        }

        return _.map(valuesAll, (value) => ({
            "name": value,
            "state": getValueState(value),
        }));

    });

    return _.zipWith(keys, valueGroups, (key, valueGroup) => ({
        "key": key,
        "values": valueGroup
    }));

}

function argmax(items) {

    // Return index of largest item in `items`.

    const max = _.max(items);
    return items.indexOf(max);
}

function createIdealMatch(product, key, newValue) {

    // Return clone of `product` with `key` assigned to `newValue`.

    var result = _.cloneDeep(product);
    result.attributes[key] = newValue;
    return result;
}

function findBestMatchProduct(products, selectedProduct, key, newValue) {

    // Find the item in `products` closest to `selectedProduct` but with `key`
    // equal to `newValue`.

    const fileteredProducts = _.filter(products, (product) => {
        return product.attributes[key] == newValue;
    });

    const idealMatch = createIdealMatch(selectedProduct, key, newValue);
    const keys = getKeys(fileteredProducts);
    const propertiesAll = getProperties(fileteredProducts, keys);
    const propertiesIdeal = getProperties([idealMatch], keys)[0];
    const similarity = _.map(propertiesAll, (prop) => dotProduct(prop, propertiesIdeal));
    const index = argmax(similarity);
    return fileteredProducts[index];
}