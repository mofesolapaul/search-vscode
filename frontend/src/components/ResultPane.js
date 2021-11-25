function ResultPane({ data }) {
    return (
        <div className="resultPane">
            <table>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Link to GitHub</th>
                </tr>
                </thead>
                <tbody>
                {data.map(result => (
                    <tr>
                        <td>{result.name}</td>
                        <td>{result.path}</td>
                        <td><a href={result.html_url} target="_blank">view on github</a></td>
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}

export default ResultPane;
