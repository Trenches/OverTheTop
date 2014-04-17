using System;
using System.Collections;

public class PlayerInfo
{
	private static System.Guid id;
	public static System.Guid ID
	{
		get{return id;}
	}

	public static bool IsSet{get{return id != Guid.Empty;}}
	
	public static void Set(string newId)
	{
		id = new Guid(newId);
	}
}
