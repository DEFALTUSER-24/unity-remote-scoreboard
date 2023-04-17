using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;

public class ServerRequest : MonoBehaviour
{
    private string server_url = "":

    /// <summary>
    /// Executes "GetScores_Coroutine()" coroutine that sends a GET request to the web server to obtain the scoreboard data.
    /// </summary>
    public void GetScores()
    {
        StartCoroutine(GetScores_Coroutine());
    }

    /// <summary>
    /// Sends a GET request to the web server.
    /// </summary>
    /// <returns></returns>
    IEnumerator GetScores_Coroutine()
    {
        string url = server_url + "?action=get-scores"; //Server URL where to do the GET request and obtain the scores.

        using (UnityWebRequest webRequest = UnityWebRequest.Get(url))
        {
            yield return webRequest.SendWebRequest();
            if (webRequest.result == UnityWebRequest.Result.Success)
            {
                /*
                 * get server response by using webRequest.downloadHandler.text
                 * Since Unity can't handle JSON arrays you should use JsonHelper class.
                 * An example would be:
                 * 
                 * ServerScoreboardData[] json = JsonHelper.FromJson<ServerScoreboardData>(json_data);
                 * 
                 * And then foreach every result.
                 * 
                 * foreach (ServerScoreboardData data in json)
                 * {
                 *     Debug.Log("Username: " + data.name + " | " + data.user_score + "\n");
                 * }
                 * 
                */
            }
            else
            {
                //Error on request.
            }
        }
    }

    /// <summary>
    /// Executes "SaveScore_Coroutine" coroutine that sends a POST request to the web server to upload the scoreboard data.
    /// </summary>
    /// <param name="playerScore"></param>
    /// <param name="playerName"></param>
    public void SaveScore(int playerScore, string playerName)
    {
        StartCoroutine(SaveScore_Coroutine(playerScore, playerName, gameLevel));
    }

    /// <summary>
    /// Sends a POST request to the web server.
    /// </summary>
    /// <param name="playerScore"></param>
    /// <param name="playerName"></param>
    /// <returns></returns>
    IEnumerator SaveScore_Coroutine(int playerScore, string playerName)
    {
        string url = server_url + "?action=add-score"; //Server URL where to do the POST request and upload a the score.

        //Create form, add inputs and values.
        WWWForm form = new WWWForm();
        form.AddField("name", playerName);
        form.AddField("score", playerScore);

        using (UnityWebRequest request = UnityWebRequest.Post(url, form))
        {
            yield return request.SendWebRequest();
            if (request.result == UnityWebRequest.Result.Success)
            {
                //If request vas successful.
            }
            else
            {
                //If request failed.
            }
        }
    }
}
