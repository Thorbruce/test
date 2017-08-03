function testNum(value) {
    var reg = /^[0-9]{6}$/;
    if (!reg.test(value)) {
        return false;
    }
    return true;
}
