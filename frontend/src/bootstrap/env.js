const camelToScreamingSnakeCase = str => str.replace(/[A-Z]/g, letter => `_${letter.toLowerCase()}`).toUpperCase();

const env = new Proxy(process.env, {
    get(target, name, receiver) {
        const transformedname = `REACT_APP_${camelToScreamingSnakeCase(name)}`;
        return Reflect.get(target, transformedname, receiver);
    }
});

export default env;
