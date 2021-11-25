import {useCallback, useState} from "react";
import Api from "../services/Api";
import ResultPane from "./ResultPane";

function SearchPane({selectedLanguage}) {
    const [searchQuery, setSearchQuery] = useState('');
    const [searchResult, setSearchResult] = useState([]);
    const [errorMessage, setErrorMessage] = useState('');
    const [noResults, setNoResults] = useState(false);

    const performSearch = useCallback(async () => {
        if (!searchQuery.trim()) {
            setErrorMessage('Please input something in the search box first.');
            return;
        }

        const response = await Api.search({
            language: selectedLanguage,
            query: searchQuery
        }).catch(e => {
            setErrorMessage(e.error);
            setNoResults(false);
        });
        if (response) {
            setErrorMessage('');
            setSearchResult(response);
            setNoResults(!response.length);
        }
    }, [searchQuery, selectedLanguage]);

    return (
        <div className="searchPane">
            <div className="searchBox mb-3">
                Search vscode:
                <form className={`input-group`} onSubmit={e => {e.preventDefault(); performSearch()}}>
                    <input className={`form-control`} type="text" value={searchQuery}
                           onChange={e => setSearchQuery(e.target.value)}/>
                    <div className="input-group-append">
                        <button
                            type={`submit`}
                            className={`btn btn-primary form-control`}>
                            Search
                        </button>
                    </div>
                </form>
                {errorMessage ? <div className={`text-danger`}>{errorMessage}</div> : null}
            </div>
            {!errorMessage && noResults ? <div className={`text-larger`}>No results found</div>:null}
            {!errorMessage && searchResult.length ? <ResultPane data={searchResult}/> : null}
        </div>
    );
}

export default SearchPane;
