using UnityEngine;
using System.Collections;

public class MainGUI : MonoBehaviour
{
	Rect loginRect;

	string userEmail = "";
	string userPassword = "";

	void Start()
	{
		CalculateRects();
	}

	void CalculateRects()
	{
		loginRect = new Rect(Screen.width * 0.5f - 100, Screen.height * 0.5f - 100, 200, 200);
	}

	void OnGUI()
	{
		if(PlayerInfo.IsSet)
			DrawFriendsList();
		else
			DrawLogin();
		
		DrawPlayerInfo();
	}

	void DrawLogin()
	{
		GUILayout.BeginArea(loginRect, "Login", GUI.skin.window);
			GUILayout.BeginHorizontal();
				GUILayout.Label("Email:");
				userEmail = GUILayout.TextField(userEmail);
			GUILayout.EndHorizontal();
			GUILayout.BeginHorizontal();
				GUILayout.Label("Password:");
				userPassword = GUILayout.TextField(userPassword);
			GUILayout.EndHorizontal();
			if(GUILayout.Button("Login"))
				StartCoroutine(LogIn());
			GUILayout.FlexibleSpace();
			if(GUILayout.Button("Forgot your password?"))
				GetForgottenPassword();
		GUILayout.EndArea();
	}

	IEnumerator LogIn()
	{
		WWW wwwLogin = new WWW("http://192.168.2.117/Login.php?Email=" + userEmail + "&PWD=" + userPassword);

		yield return wwwLogin;

		if(!string.IsNullOrEmpty(wwwLogin.error))
			Debug.Log(wwwLogin.error);

		if(wwwLogin.text == "Invalid")
			Debug.Log("Login failed.");
		else
			PlayerInfo.Set(wwwLogin.text);
	}

	void GetForgottenPassword()
	{
		Application.OpenURL("http://192.168.2.117/ForgottenPassword.php?Email=" + userEmail);
	}

	void DrawFriendsList()
	{

	}

	void DrawPlayerInfo()
	{
		GUILayout.BeginArea(new Rect(5, 5, 400, 100), "PlayerInfo", GUI.skin.window);
			GUILayout.Box("PlayerID: " + PlayerInfo.ID);
		GUILayout.EndArea();
	}
}
